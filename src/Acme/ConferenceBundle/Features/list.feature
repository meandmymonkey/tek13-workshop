
Feature: Conference List

Scenario: Browse Empty List
    Given the database is clear
    And I am on "/conference"
    Then the response status code should be 200
    And I should see 0 "li.well" elements

Scenario: Browse List
    Given the database starts out clear
    And there is one conference called "TestCon" in "Berlin"
    And I am on "/conference"
    Then the response status code should be 200
    And I should see 1 "li.well" elements
    And I should see "Overview"
    And I should see "Create"

Scenario: Click "Create" in Navigation
    Given I am on "/conference"
    When I follow "Create"
    Then the URL should match "/conference/create"

Scenario: Click "Edit" in list entry
    Given I am on "/conference"
    When I follow "Edit"
    Then the URL should match "/conference/testcon"
