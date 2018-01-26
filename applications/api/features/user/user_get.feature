Feature: Find a user
  In order to be the best youtuber ever
  As a codelyver
  I want to find a user

  Background:
    Given there is a user:
      | id                   | fe7017d0-9e8f-4952-99d1-e047e36b1694 |
      | total_pending_videos | 5                                    |
      | name                 | Vicenç                               |

  Scenario: Find an existing user
    Given I send a GET request to "/users/fe7017d0-9e8f-4952-99d1-e047e36b1694"
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
    Given I send a GET request to "/users/05ed7eb7-7888-4730-b9e9-0c16cfa80b80"
    Then the response status code should be 404
    And the response content should be:
    """
    {
      "code": "user_not_exist",
      "message": "The user <05ed7eb7-7888-4730-b9e9-0c16cfa80b80> does not exists"
    }
    """
