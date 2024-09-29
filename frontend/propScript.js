//Sample property data
const properties = [
  {
    id: 1,
    title: "Property 1",
    location: "Location 1",
    price: "$100,000",
    image: "property1.jpg",
    description: "This is property 1.",
  },
];

//Function to generate property cards
function generatePropertyCards() {
  const propertyList = document.getElementById("property-list");

  if (properties.length === 0) {
    //Display a card with a "Create Property" button if there are no properties
    const createPropertyCard = document.createElement("div");
    createPropertyCard.classList.add("create-property-card");
    createPropertyCard.innerHTML = `
            <button onclick="redirectToCreateProperty()">Create Property</button>
        `;
    propertyList.appendChild(createPropertyCard);
  }

  //Display property cards and  create cards
  properties.forEach((property) => {
    const card = document.createElement("div");
    card.classList.add("property-card");
    card.innerHTML = `
            <img src="${property.image}" alt="${property.title}">
            <h2>${property.title}</h2>
            <p>Location: ${property.location}</p>
            <p>Price: ${property.price}</p>
            <button onclick="showPropertyDetails(${property.id})">View Details</button>
        `;
    const createPropertyCard = document.createElement("div");
    createPropertyCard.classList.add("create-property-card");
    createPropertyCard.innerHTML = `
     <button onclick="redirectToCreateProperty()">Create Property</button>
 `;
    propertyList.appendChild(createPropertyCard);
    propertyList.appendChild(card);
  });
}
function redirectToCreateProperty() {
  window.location.href = "./createproperty.html";
}

///Function to show property details modal
function showPropertyDetails(propertyId) {
  const property = properties.find((p) => p.id === propertyId);

  if (property) {
    const modal = document.getElementById("property-details-modal");
    modal.innerHTML = `
            <img src="${property.image}" alt="${property.title}">
            <h2>${property.title}</h2>
            <p>Location: ${property.location}</p>
            <p>Price: ${property.price}</p>
            <p>Description: ${property.description}</p>         
            <button id="update-button" class="property-detail-btn" onclick="openUpdateForm()">Update Property</button>
            <button class="property-detail-btn" onclick="deleteProperty(${property.id})">Delete</button>
            <button class="property-detail-btn" onclick="closePropertyModal()">Close</button>
        `;

    modal.style.display = "block";
  }
}
//function to redirect to update property page
function openUpdateForm() {
  const modal = document.getElementById("property-details-modal");
  //Hide the property details modal
  modal.style.display = "none";
  window.location.href = "./updateproperty.html";
}
//function to delete property
function deleteProperty(propertyId) {
  const property = properties.find((p) => p.id === propertyId);
  if (property) {
    const modal = document.getElementById("property-details-modal");
    modal.style.display = "none";
    const index = properties.indexOf(property);
    properties.splice(index, 1);
    generatePropertyCards();
  }
}
//fucntion to close properties modal
function closePropertyModal() {
  const modal = document.getElementById("property-details-modal");
  modal.style.display = "none";
}
//Simulate fetching property data from the server (replace with actual fetch logic)
function fetchPropertiesFromServer() {
    generatePropertyCards();

}

fetchPropertiesFromServer();
