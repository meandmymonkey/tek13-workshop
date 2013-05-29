
Feature: Edit Conference Entry

Background:
    Given the database starts out clear
    And there is one conference called "TestCon" in "Berlin"
    And I am on "/conference/testcon"
    Then the response status code should be 200
    And the "Name" field should contain "TestCon"

Scenario: Edit title
    Given I fill in "Name" with "AnotherCon"
    And I press "Save"
    Then the response status code should be 200
    And the URL should match "/conference/$"
    And I should see "AnotherCon"
    And I should see 1 "li.well" elements

Scenario: Delete entry
    Given I press "Delete"
    Then the response status code should be 200
    And the URL should match "/conference/$"
    And I should see 0 "li.well" elements
