describe('Formulaire d\'inscription', () => {
    it('test 1 - inscription OK', () => {
        cy.visit('127.0.0.1:8000/register');

        // Entrer le nom d'utilisateur et le mot de passe
        cy.get('#registration_form_email').type('test2@test2.fr');
        cy.get('#registration_form_plainPassword_first').type('123456');
        cy.get('#registration_form_plainPassword_second').type('123456');


        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que l'utilisateur est inscrit
        cy.contains('Login').should('exist');
    });

    it('test 2 - inscription KO', () => {
        cy.visit('127.0.0.1:8000/register');

        // Entrer un nom d'utilisateur et un mot de passe incorrects
        cy.get('#registration_form_email').type('test2@test2.fr');
        cy.get('#registration_form_plainPassword_first').type('123');
        cy.get('#registration_form_plainPassword_second').type('123');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le message d'erreur est affiché
        cy.contains('Your password should be at least 6 characters').should('exist');
    });
});