package base

type ResponseFailure struct {
	Status  string `json:"status"`
	Message string `json:"message"`
}
