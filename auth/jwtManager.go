package auth

import (
	"errors"
	"github.com/golang-jwt/jwt"
	"github.com/google/uuid"
	"time"
)

type JWTManager struct {
	singingKey string
	timeToLive time.Duration
}

func NewJWTManager(
	singingKey string,
	timeToLive time.Duration) (*JWTManager, error) {
	if singingKey == "" {
		return nil, errors.New("key empty")
	}

	return &JWTManager{singingKey: singingKey, timeToLive: timeToLive}, nil
}

func (m *JWTManager) NewJWT(userID uuid.UUID) (string, error) {
	token := jwt.NewWithClaims(jwt.SigningMethodHS256, jwt.StandardClaims{
		ExpiresAt: time.Now().Add(m.timeToLive).Unix(),
		Subject:   userID.String(),
	})

	return token.SignedString([]byte(m.singingKey))
}

func (m *JWTManager) Parse(accessToken string) (string, error) {
	token, err := jwt.Parse(accessToken, func(token *jwt.Token) (i interface{}, err error) {
		if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
			return nil, errors.New("jwt error")
		}

		return []byte(m.singingKey), nil
	})

	if err != nil {
		return "", err
	}

	claims, ok := token.Claims.(jwt.MapClaims)
	if !ok {
		return "", errors.New("jwt error")
	}

	return claims["sub"].(string), nil
}
