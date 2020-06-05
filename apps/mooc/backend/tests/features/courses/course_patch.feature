Feature: Rename an existing course
  In order to have courses up to date on the platform
  As a user with admin permissions
  I want to rename the name of an existing course

  Scenario: A valid existing course
    Given A course with id "c77fa036-cbc7-4414-996b-c6a7a93cae09" and title "First title!" and duration of "25 hours"
    When I send a PATCH request to "/courses/c77fa036-cbc7-4414-996b-c6a7a93cae09" with body:
    """
    [
        {
            "op": "replace",
            "path": "/name",
            "value": "Second name of the course"
        }
    ]
    """
    Then the course with id "c77fa036-cbc7-4414-996b-c6a7a93cae09" has a title "Second name of the course"
    And the response status code should be 200
    And the response should be empty
