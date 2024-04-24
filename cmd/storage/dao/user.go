package dao

import (
	"FOODAPI/domain/entity"
	"context"

	"github.com/google/uuid"
	"gorm.io/gorm"
)

type UserStorage struct {
	db *gorm.DB
}

func NewUserStorage(db *gorm.DB) *UserStorage {
	return &UserStorage{
		db: db,
	}
}

func (s *UserStorage) Create(user *entity.User, ctx context.Context) error {
	return s.db.WithContext(ctx).Create(&user).Error
}

func (s *UserStorage) Retrieve(userID uuid.UUID, ctx context.Context) (*entity.User, error) {
	var user entity.User
	if err := s.db.WithContext(ctx).First(&user, userID).Error; err != nil {
		return nil, err
	}

	return &user, nil
}

func (s *UserStorage) CreateSession(session *entity.Session, ctx context.Context) error {
	return s.db.WithContext(ctx).Create(session).Error
}

func (s *UserStorage) GetUserByEmail(email string, ctx context.Context) (*entity.User, error) {
	var user entity.User
	if err := s.db.WithContext(ctx).Where("email = ?", email).First(&user).Error; err != nil {
		return nil, err
	}

	return &user, nil
}

func (s *UserStorage) GetSessionByUserID(userID uuid.UUID, ctx context.Context) (*entity.Session, error) {
	var session entity.Session
	if err := s.db.WithContext(ctx).Where("user_id = ?", userID).First(&session).Error; err != nil {
		return nil, err
	}

	return &session, nil
}
