Feature: Create a new video
  In order to have videos on the platform
  As a user with admin permissions
  I want to create a new video

  Scenario: A valid non existing video
    Given I send a PUT request to "/videos/3c5e9a1f-2b7d-4e8a-9f61-0d4b7c2e8a15" with body:
    """
    {
      "type": "screencast",
      "title": "The best video",
      "url": "https://codely.com/videos/the-best-video",
      "course_id": "1aab45ba-3c7a-4344-8936-78466eca77fa"
    }
    """
    Then the response status code should be 201
    And the response should be empty
