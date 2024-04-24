package controllers

import (
	"FOODAPI/api/middleware"
	"FOODAPI/api/model"
	"FOODAPI/cmd/services"
	"net/http"

	"github.com/gin-gonic/gin"
	"github.com/google/uuid"
)

type AuthController struct {
	service *services.AuthService
}

func NewAuthController(service *services.AuthService) *AuthController {
	return &AuthController{
		service: service,
	}
}

func (a *AuthController) Register(c *gin.Context) {
	var payload model.RegisterRequest
	if err := c.ShouldBindJSON(&payload); err != nil {
		c.JSON(http.StatusBadRequest, "error pars payload")
		return
	}

	id, serviceErr := a.service.Register(payload, c)
	if serviceErr != nil {
		c.JSON(http.StatusInternalServerError, "ERROR")
	}

	c.JSON(http.StatusOK, map[string]interface{}{
		"ID": id,
	})
}

func (a *AuthController) Login(c *gin.Context) {
	var payload model.LoginRequest
	if err := c.ShouldBindJSON(&payload); err != nil {
		c.JSON(http.StatusBadRequest, "error pars payload")
		return
	}

	jwt, refresh, serviceErr := a.service.Login(payload, c)
	if serviceErr != nil {
		c.JSON(http.StatusInternalServerError, "ERROR")
	}

	c.JSON(http.StatusOK, map[string]interface{}{
		"jwt":          jwt,
		"refreshToken": refresh,
	})
}

func (a *AuthController) GetUser(c *gin.Context) {

	userID, _ := c.Get(middleware.UserIDKey)

	user, err := a.service.GetUser(userID.(uuid.UUID), c)
	if err != nil {
		c.JSON(http.StatusInternalServerError, "ERROR")
	}

	c.JSON(http.StatusOK, user)
}
