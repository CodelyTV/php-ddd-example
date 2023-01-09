Feature: Create a new video in a course
  In order to have video on the platform
  As a user with admin permissions
  I want to create a new video

  Scenario: A valid non existing video
    Given I send a PUT request to "/videos/1aab45ba-3c7a-4344-8936-78466eca77fa" with body:
    """
    {
      "type": "screencast",
      "title": "The best video",
      "url": "https://www.youtube.com/watch?v=QH2-TGUlwu4",
      "courseId": "1aab45ba-3c7a-4344-8936-78466eca77fa"
    }
    """
    Then the response status code should be 201
    And the response should be empty
