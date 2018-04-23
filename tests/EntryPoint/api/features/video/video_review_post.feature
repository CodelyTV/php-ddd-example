Feature: review a video
  In order to be the best youtuber ever
  As a codelyver
  I want to review a video

  Background:
    Given I send a POST request to "/video" with body:
    """
    {
      "request_id": "170cfccd-869d-414b-a521-9cce9e0e67a2",
      "id": "465892a1-5a77-4cee-9450-46ecd6b68f69",
      "title": "Exprimiendo los tipos de PHP7",
      "url": "https://codely.tv/screencasts/tipos-php-7/",
      "type": "screencast",
      "course_id": "9c8a481a-0fe2-49cf-ab8a-79bcc2965d00"
    }
    """
    Then the response should be empty
    And the response status code should be 201

  Scenario: Review an existing video
    Given I send a POST request to "/video/465892a1-5a77-4cee-9450-46ecd6b68f69/review" with body:
    """
    {
      "request_id": "8e86566b-b86f-4e66-9490-0cd6cff5550e",
      "id": "039b8f8b-8942-47f3-b6f6-dbe2c4012156",
      "rating": 5,
      "text": "Amazing course"
    }
    """
    Then the response should be empty
    And the response status code should be 201
