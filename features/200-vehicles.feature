Feature: Vehicles

Scenario: Agree to cookie policy
    @breaks-local
    Given I am on "/tools/tco"
    And I wait for "10" seconds
    When I click button with id "buttonAccept"

Scenario: Add four vehicles
    Given I am on "/tools/tco"
    #When I click button with id "buttonAccept"
    And I click button with title "e-NV200 (4)"
    And I fill in the following:
    	| choose-grade | Acenta (1) |
    And I click button with title "View models as grid"
    And I click button with class "add-to-basket"
    And I should see "YOUR VEHICLE SELECTION"
    And I should see "Your vehicle has been added"
    And I click button with title "Add another vehicle"


    When I check "manu-other" radio button
    And I select "MERCEDES-BENZ (491)" in element "manufacturer"
    And I wait for "3" seconds
    And I select "C CLASS (150)" in element "other-select-step-2"
    And I wait for "3" seconds
    And I click button with title "Passenger Cars"
    And I wait for "3" seconds
    And I select "AMG Edition 507 (1)" in element "other-choose-grade"
    And I wait for "3" seconds
    And I click button with class "add-to-basket" 
    And I should see "YOUR VEHICLE SELECTION"
    And I should see "Your vehicle has been added"
    And I click button with title "Add another vehicle"

    When I click button with title "Commercial Vehicles"
    And I click button with title "NAVARA (8)"
    And I fill in the following:
    	| choose-grade | Pick-up (1) |    
    And I click button with title "View models as grid"
    And I click button with class "add-to-basket"
    And I should see "YOUR VEHICLE SELECTION"
    And I should see "Your vehicle has been added"
    And I click button with title "Add another vehicle"

    When I click button with title "Commercial Vehicles"
    And I check "manu-other" radio button
    And I select "HYUNDAI (3)" in element "manufacturer"
    And I wait for "3" seconds
    And I select "ILOAD (3)" in element "other-select-step-2"
    And I wait for "3" seconds
    And I click button with title "Commercial Vehicles"
    And I wait for "3" seconds
    And I select "Crew Bus (1)" in element "other-choose-grade"
    And I wait for "3" seconds
    And I click button with class "add-to-basket" 
    And I should see "YOUR VEHICLE SELECTION"
    And I should see "Your vehicle has been added"
    And I click button with title "Calculate tax"
    Then the URL should match "/tools/tco/terms"
    And I should see "TOTAL COST OF OWNERSHIP CALCULATOR"

    When I press "Calculate >"
    #Adn I should see "4" vehicles        