package base

import (
	"github.com/google/uuid"
	"time"
)

type EntityWithIdKey struct {
	ID        uuid.UUID `gorm:"type:uuid;default:uuid_generate_v1();primaryKey"`
	CreatedAt time.Time
	UpdatedAt time.Time
	DeletedAt time.Time
}
