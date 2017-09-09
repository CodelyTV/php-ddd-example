Feature: Find a video
  In order to be the best youtuber ever
  As a codelyver
  I want to find a video

  Background:
    Given  I send a POST request to "/video" with body:
    """
    {
      "request_id": "8ca6c44c-c6ca-4a31-a66b-627473ddde54",
      "id": "c531eff4-137e-401d-abc3-52fdc59c0598",
      "title": "Most awesome video ever",
      "url": "http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes",
      "course_id": "8e5c36d2-198a-4b5e-b6f4-0973b7d76244"
    }
    """
    Then the response should be empty
    And the response status code should be 201

  Scenario: Find an existing video
    Given I send a GET request to "/video/c531eff4-137e-401d-abc3-52fdc59c0598"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "c531eff4-137e-401d-abc3-52fdc59c0598",
      "title": "Most awesome video ever",
      "url": "http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes",
      "course_id": "8e5c36d2-198a-4b5e-b6f4-0973b7d76244"
    }
    """

  Scenario: Find a non existing video
    Given I send a GET request to "/video/09acb178-0831-4d86-a364-bff0e19d8f19"
    Then the response status code should be 404
    And the response content should be:
    """
    {
      "code": "video_not_found",
      "message": "The video <09acb178-0831-4d86-a364-bff0e19d8f19> has not been found"
    }
    """
