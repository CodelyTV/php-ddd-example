Feature: Create a new course
  In order to have courses on the platform
  As a user with admin permissions
  I want to create a new course

  Scenario: A valid non existing course
    Given I send a POST request to "/courses" with body:
    """
    {
      "id": "1aab45ba-3c7a-4344-8936-78466eca77fa",
      "name": "The best course",
      "duration": "5 hours"
    }
    """
    Then the response status code should be 200
    And the current url should be "/courses"
    And I should see "The best course"
