Feature: Modify video description

   In order to be the best youtuber ever
   As a codelyver
   I want to update the description of a video

  Background:
    Given I send a POST request to "/video" with body:
    """
    {
      "request_id": "170cfccd-869d-414b-a521-9cce9e0e67a2",
      "id": "465892a1-5a77-4cee-9450-46ecd6b68f69",
      "title": "Exprimiendo los tipos de PHP7",
      "description": "hola",
      "url": "https://codely.tv/screencasts/tipos-php-7/",
      "type": "screencast",
      "course_id": "9c8a481a-0fe2-49cf-ab8a-79bcc2965d00"
    }
    """
    Then the response should be empty
    And the response status code should be 201

  Scenario: Modify the description of an existent video
  Given I send a PATCH request to "/video/465892a1-5a77-4cee-9450-46ecd6b68f69/description" with body:
    """
    {
      "request_id": "170cfccd-869d-414b-a521-9cce9e0e67a3",
      "newDescription": "Exprimiendo los tipos de PHP7.4"
    }
    """
   Then the response should be empty
    And the response status code should be 204
