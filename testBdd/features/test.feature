Feature: S2 Rechercher un utilisateur
In order to contact people depending on their location, association, profession...
As a member of "Mon espace FNE13"
I need to be able to see a list of results depending on the search I did

Scenario: List 3 results in the datatable
	Given I am an association "Le Loubatas"
	And I have a member "Charly Castor"
	And I have a member "Henry Lerat" 
	And I have a member "Roger Lacréance"
	When I search for "Le Loubatas" in the field Association
	Then I should see in the datatable:
	  """
	  Charly Castor
	  Henry Lerat
	  Roger Lacréance
	  """ 
