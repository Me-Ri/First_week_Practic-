package migration

import (
	"FOODAPI/domain/base"
	"FOODAPI/domain/entity"
	"FOODAPI/domain/enum"
	"errors"

	"github.com/google/uuid"
	"gorm.io/gorm"
)

func Migration(
	db *gorm.DB,
	adminID uuid.UUID,
	adminName, adminEmail, adminPassword string) error {

	if err := db.AutoMigrate(
		&entity.Session{},
		&entity.User{}); err != nil {
		return err
	}

	if err := adminMigration(db, adminID, adminName, adminEmail, adminPassword); err != nil {
		return err
	}

	return nil
}

func adminMigration(db *gorm.DB, adminID uuid.UUID, adminName, adminEmail, adminPassword string) error {
	tx := db.First(&entity.User{}, adminID)
	if tx.Error != nil {
		if !errors.Is(tx.Error, gorm.ErrRecordNotFound) {
			return tx.Error
		}
	}

	if tx.RowsAffected == 0 {
		admin := &entity.User{
			EntityWithIdKey: base.EntityWithIdKey{
				ID: adminID,
			},
			Email:    adminEmail,
			Name:     adminName,
			Password: adminPassword,
			Role:     enum.MANAGER,
		}

		if err := db.Create(admin).Error; err != nil {
			return err
		}
	}

	return nil
}
