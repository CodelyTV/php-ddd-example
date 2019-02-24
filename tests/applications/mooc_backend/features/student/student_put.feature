Feature: Sign up a student
  In order to learn from CodelyTV Pro courses
  As an anonymous student
  I want to sign up to the platform

  Scenario: Sign up a new student
    Given I send a PUT request to "/students/0ca24fc4-bdc8-48d0-9c5f-94183a627adc" with body:
    """
    {
      "name": "javi"
    }
    """
    Then the response status code should be 201
    And the response should be empty
