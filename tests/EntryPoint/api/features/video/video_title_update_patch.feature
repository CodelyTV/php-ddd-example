Feature: Create video
  In order to be the best youtuber ever
  As a codelyver
  I want to update a video title

  Scenario: Create an screencast video
    Given  I send a POST request to "/video" with body:
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

  Scenario: Update video title
    Given  I send a PATCH request to "/video" with body:
    """
    {
      "request_id": "6ee07c6b-a1e7-4cfa-abf5-cbfd4884cd75",
      "id": "465892a1-5a77-4cee-9450-46ecd6b68f69",
      "title": "Exprimiendo los tipos de PHP7 V2",
    }
    """
    Then the response should be empty
    And the response status code should be 204
