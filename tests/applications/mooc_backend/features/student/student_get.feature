Feature: Find a student
  In order to learn from CodelyTV Pro courses
  As an authenticated student
  I want to view my profile details

  Background:
    Given there is an student:
      | id                   | fe7017d0-9e8f-4952-99d1-e047e36b1694 |
      | total_pending_videos | 5                                    |
      | name                 | Vicenç                               |

  Scenario: Find an existing student
    Given I send a GET request to "/students/fe7017d0-9e8f-4952-99d1-e047e36b1694"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "fe7017d0-9e8f-4952-99d1-e047e36b1694",
      "name": "Vicenç",
      "total_pending_videos": 5
    }
    """

  Scenario: Not find a non existing video
    Given I send a GET request to "/students/05ed7eb7-7888-4730-b9e9-0c16cfa80b80"
    Then the response status code should be 404
    And the response content should be:
    """
    {
      "code": "student_not_exist",
      "message": "The student <05ed7eb7-7888-4730-b9e9-0c16cfa80b80> does not exists"
    }
    """
