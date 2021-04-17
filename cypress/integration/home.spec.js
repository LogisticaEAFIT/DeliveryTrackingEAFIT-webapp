describe('Home', () => {

  it('Home Page', () => {
    cy.visit('http://127.0.0.1:8000');
    cy.contains('Home');
  });

  it('Login Page', () => {
    cy.visit('http://127.0.0.1:8000');
    cy.get('a').contains('Login').click();
    cy.url().should('include', '/login');
    cy.get('label').should('contain', 'E-Mail Address');
  });

});