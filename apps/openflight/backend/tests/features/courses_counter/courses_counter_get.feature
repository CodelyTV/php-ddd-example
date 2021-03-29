Feature: Obtain the total number of courses
  In order to have a courses counter
  As a user
  I want to see the courses counter

  Scenario: With one course
    Given I send an event to the event bus:
    """
    {
      "data": {
        "id": "c77fa036-cbc7-4414-996b-c6a7a93cae09",
        "type": "course.created",
        "occurred_on": "2019-08-08T08:37:32+00:00",
        "attributes": {
          "id": "8c900b20-e04a-4777-9183-32faab6d2fb5",
          "name": "DDD en PHP!",
          "duration": "25 hours"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    When I send a "GET" request to "/courses-counter"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "total": 1
    }
    """

  Scenario: With more than one course having duplicates
    Given I send an event to the event bus:
    """
    {
      "data": {
        "id": "c77fa036-cbc7-4414-996b-c6a7a93cae09",
        "type": "course.created",
        "occurred_on": "2019-08-08T08:37:32+00:00",
        "attributes": {
          "id": "8c900b20-e04a-4777-9183-32faab6d2fb5",
          "name": "DDD en PHP!",
          "duration": "25 hours"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    And I send an event to the event bus:
    """
    {
      "data": {
        "id": "8c4a4ed8-9458-489e-a167-b099d81fa096",
        "type": "course.created",
        "occurred_on": "2019-08-09T08:36:32+00:00",
        "attributes": {
          "id": "8c4a4ed8-9458-489e-a167-b099d81fa096",
          "name": "DDD en Java",
          "duration": "24 hours"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    And I send an event to the event bus:
    """
    {
      "data": {
        "id": "8c4a4ed8-9458-489e-a167-b099d81fa096",
        "type": "course.created",
        "occurred_on": "2019-08-09T08:36:32+00:00",
        "attributes": {
          "id": "8c4a4ed8-9458-489e-a167-b099d81fa096",
          "name": "DDD en Java",
          "duration": "24 hours"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    When I send a "GET" request to "/courses-counter"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "total": 2
    }
    """
