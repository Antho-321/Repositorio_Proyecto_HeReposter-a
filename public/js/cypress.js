function searchAndGetFirstImageLink() {
    cy.visit('https://www.google.es/imghp?hl=en&ogbl'); // Visit Google Images
    cy.get('input.gLFyf').type('cake{enter}'); // Type 'cake' in the search box and press 'Enter'
    cy.get('div.bRMDJf.islir > img').first() // Select the first image
      .invoke('attr', 'src') // Get the 'src' attribute of the image
      .then((imageUrl) => {
        // The 'imageUrl' contains the link to the first image
        cy.log(imageUrl); // Log the image URL to the Cypress console
        return imageUrl; // Return the image URL
      });
}
searchAndGetFirstImageLink();