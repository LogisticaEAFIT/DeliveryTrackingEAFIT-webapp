describe('Home', () => {

  it('Home Page', () => {
    cy.visit('/');
    cy.contains('Home');
  });

  it('Login Page', () => {
    cy.visit('/');
    cy.get('a').contains('Login').click();
    cy.url().should('include', '/login');
    cy.get('label').should('contain', 'E-Mail Address');
  });

});