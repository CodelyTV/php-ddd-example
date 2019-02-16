Feature: Find a video
  In order to be the best youtuber ever
  As a codelyver
  I want to find a video

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

  Scenario: Find an existing video
    Given I send a GET request to "/video/465892a1-5a77-4cee-9450-46ecd6b68f69"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "465892a1-5a77-4cee-9450-46ecd6b68f69",
      "title": "Exprimiendo los tipos de PHP7",
      "url": "https://codely.tv/screencasts/tipos-php-7/",
      "type": "screencast",
      "course_id": "9c8a481a-0fe2-49cf-ab8a-79bcc2965d00"
    }
    """

  Scenario: Not find a non existing video
    Given I send a GET request to "/video/09acb178-0831-4d86-a364-bff0e19d8f19"
    Then the response status code should be 404
    And the response content should be:
    """
    {
      "code": "video_not_found",
      "message": "The video <09acb178-0831-4d86-a364-bff0e19d8f19> has not been found"
    }
    """
