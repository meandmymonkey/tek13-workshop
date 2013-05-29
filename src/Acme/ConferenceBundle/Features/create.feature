
Feature: Create Conference Entry

Background:
    Given the database starts out clear
    And there is one conference called "TestCon" in "Berlin"
    And I am on "/conference/create"
    Then the response status code should be 200

Scenario: Create entry
    Given I fill in "Name" with "SomeCon"
    And I fill in "Location" with "London"
    And I fill in "conference[startDate][month]" with "5"
    And I fill in "conference[startDate][day]" with "5"
    And I fill in "conference[startDate][year]" with "2013"
    And I fill in "conference[endDate][month]" with "5"
    And I fill in "conference[endDate][day]" with "6"
    And I fill in "conference[endDate][year]" with "2013"
    And I press "Save"
    Then the response status code should be 200
    And the URL should match "/conference/$"
    And I should see 2 "li.well" elements
    And I should see "SomeCon"
    And I should see "London"

