Feature: Obtain the last video
  In order to have a the last video published on the platform
  As a user
  I want to see the last video

  Scenario: With the last video published
    Given I send an event to the event bus:
    """
    {
      "data": {
        "id": "c77fa036-cbc7-4414-996b-c6a7a93cae09",
        "type": "video.created",
        "occurred_on": "2019-08-08T08:37:32+00:00",
        "attributes": {
          "id": "1aab45ba-3c7a-4344-8936-78466eca77fa",
          "type": "screencast",
          "title": "The best video",
          "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
          "course_id": "1aab45ba-3c7a-4344-8936-78466eca77fa"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    When I send a "GET" request to "/last-video"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "1aab45ba-3c7a-4344-8936-78466eca77fa",
      "type": "screencast",
      "title": "The best video",
      "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
      "courseId": "1aab45ba-3c7a-4344-8936-78466eca77fa"
    }
    """

  Scenario: With more than one video having duplicates
    Given I send an event to the event bus:
    """
    {
      "data": {
        "id": "c77fa036-cbc7-4414-996b-c6a7a93cae09",
        "type": "video.created",
        "occurred_on": "2019-08-08T08:37:12+00:00",
        "attributes": {
          "id": "1aab45ba-3c7a-4344-8936-78466eca77fa",
          "type": "screencast",
          "title": "The first video",
          "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
          "course_id": "1aab45ba-3c7a-4344-8936-78466eca77fa"
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
        "type": "video.created",
        "occurred_on": "2019-08-08T08:37:32+00:00",
        "attributes": {
          "id": "1aab45ba-3c7a-4344-8936-78466eca772b",
          "type": "screencast",
          "title": "The last video",
          "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
          "course_id": "1aab45ba-3c7a-4344-8936-78466eca77fa"
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
        "type": "video.created",
        "occurred_on": "2019-08-08T08:37:32+00:00",
        "attributes": {
          "id": "1aab45ba-3c7a-4344-8936-78466eca772b",
          "type": "screencast",
          "title": "The last video",
          "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
          "course_id": "1aab45ba-3c7a-4344-8936-78466eca77fa"
        },
        "meta" : {
          "host": "111.26.06.93"
        }
      }
    }
    """
    When I send a "GET" request to "/last-video"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "1aab45ba-3c7a-4344-8936-78466eca772b",
      "type": "screencast",
      "title": "The last video",
      "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
      "courseId": "1aab45ba-3c7a-4344-8936-78466eca77fa"
    }
    """
