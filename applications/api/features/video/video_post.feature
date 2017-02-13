Feature: Create video
  In order to be the best youtuber ever
  As a codelyver
  I want to create a video

  Scenario: Create a video
    Given  I send a POST request to "/video" with body:
    """
    {
      "id": "c531eff4-137e-401d-abc3-52fdc59c0598",
      "title": "Most awesome video ever",
      "url": "http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes",
      "course_id": "8e5c36d2-198a-4b5e-b6f4-0973b7d76244"
    }
    """
    Then the response should be empty
    And the response status code should be 201
