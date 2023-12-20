Feature: List all courses
  In order to list courses on the platform
  I want to list all courses

  Scenario: List all courses
    Given I send a GET request to "/courses"
    Then the response status code should be 200
    And the response should not be empty
