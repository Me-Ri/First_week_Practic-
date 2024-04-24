package services

import (
	"FOODAPI/api/model"
	"FOODAPI/auth"
	"FOODAPI/cmd/storage/dao"
	"FOODAPI/domain/base"
	"FOODAPI/domain/entity"
	"context"

	"github.com/google/uuid"
)

type AuthService struct {
	storage    *dao.UserStorage
	hasher     *auth.Hasher
	jwtManager *auth.JWTManager
}

func NewAuthService(
	storage *dao.UserStorage,
	hasher *auth.Hasher,
	jwtManager *auth.JWTManager) *AuthService {
	return &AuthService{
		storage:    storage,
		hasher:     hasher,
		jwtManager: jwtManager,
	}
}

func (s *AuthService) Register(request model.RegisterRequest, ctx context.Context) (*uuid.UUID, *base.ServiceError) {
	hashPassword, err := s.hasher.Hash(request.Password)
	if err != nil {
		return nil, &base.ServiceError{
			Code: 123,
		}
	}

	user := &entity.User{
		Name:     request.Name,
		Email:    request.Email,
		Password: hashPassword,
	}

	if err := s.storage.Create(user, ctx); err != nil {
		return nil, &base.ServiceError{
			Code: 500,
		}
	}

	return &user.ID, nil
}

func (s *AuthService) Login(request model.LoginRequest, ctx context.Context) (*string, *uuid.UUID, *base.ServiceError) {
	user, err := s.storage.GetUserByEmail(request.Email, ctx)
	if err != nil {
		return nil, nil, &base.ServiceError{
			Code: 404,
		}
	}

	hashPassword, err := s.hasher.Hash(request.Password)
	if err != nil {
		return nil, nil, &base.ServiceError{
			Code: 500,
		}
	}

	if hashPassword != user.Password {
		return nil, nil, &base.ServiceError{
			Code: 401,
		}
	}

	session := &entity.Session{
		UserID: user.ID,
	}

	if err := s.storage.CreateSession(session, ctx); err != nil {
		return nil, nil, &base.ServiceError{Code: 500}
	}

	token, err := s.jwtManager.NewJWT(user.ID)
	if err != nil {
		return nil, nil, &base.ServiceError{
			Code: 500,
		}
	}

	return &token, &session.ID, nil
}

func (s *AuthService) GetUser(userID uuid.UUID, ctx context.Context) (*entity.User, *base.ServiceError) {
	user, err := s.storage.Retrieve(userID, ctx)
	if err != nil {
		return nil, &base.ServiceError{
			Code: 400,
		}
	}

	return user, nil
}
