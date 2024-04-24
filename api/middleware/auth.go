package middleware

import (
	"FOODAPI/auth"
	"FOODAPI/domain/base"
	"fmt"
	"net/http"
	"strings"

	"github.com/gin-gonic/gin"
	"github.com/google/uuid"
)

const (
	authHeader = "Authorization"
	UserIDKey  = "userID"
)

func SetAuthorizationCheck(JWTManager *auth.JWTManager) gin.HandlerFunc {
	return func(c *gin.Context) {

		header := c.GetHeader(authHeader)
		if header == "" {
			c.AbortWithStatusJSON(http.StatusUnauthorized, base.ResponseFailure{
				Status:  http.StatusText(http.StatusUnauthorized),
				Message: "unauthorized",
			})
			return
		}

		headerParts := strings.Split(header, " ")
		if len(headerParts) != 2 {
			fmt.Print("LEN JWT")
			c.AbortWithStatusJSON(http.StatusUnauthorized, base.ResponseFailure{
				Status:  http.StatusText(http.StatusUnauthorized),
				Message: "unauthorized",
			})
			return
		}

		stringUserID, err := JWTManager.Parse(headerParts[1])
		if err != nil {
			fmt.Print(err)
			c.AbortWithStatusJSON(http.StatusUnauthorized, base.ResponseFailure{
				Status:  http.StatusText(http.StatusUnauthorized),
				Message: "unauthorized",
			})
			return
		}

		userID, err := uuid.Parse(stringUserID)
		if err != nil {
			fmt.Print(err)
			c.AbortWithStatusJSON(http.StatusUnauthorized, base.ResponseFailure{
				Status:  http.StatusText(http.StatusUnauthorized),
				Message: "unauthorized",
			})
			return
		}

		c.Set(UserIDKey, userID)
		c.Next()
	}
}
