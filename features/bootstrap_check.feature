Feature: Bootstrap check

  Scenario Outline: Console check
    When I run the "<app>" console
    Then the console command should run successfully
    Examples:
      | app    |
      | codely |
      | api    |
