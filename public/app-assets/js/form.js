// Add block button click event
document.getElementById("add-block").addEventListener("click", (event) => {
  event.preventDefault();
  addBlock();
});

// Move up button click event
document.addEventListener("click", function(event) {
  if (event.target && event.target.className === "move-up") {
    moveUp(event.target.parentNode.parentNode);
  }
});

// Move down button click event
document.addEventListener("click", function(event) {
  if (event.target && event.target.className === "move-down") {
    moveDown(event.target.parentNode.parentNode);
  }
});

// Delete button click event
document.addEventListener("click", function(event) {
  if (event.target && event.target.className === "delete") {
    deleteBlock(event.target.parentNode.parentNode);
  }
});

// Function to add a new block
function addBlock() {
  const blockContainer = document.getElementById("block-container");
  const blockCount = blockContainer.getElementsByClassName("block").length + 1;

  // Create a new block element
  const newBlock = document.createElement("div");
  newBlock.classList.add("block");

  // Create a row for item number and outfit name
  const row1 = document.createElement("div");
  row1.classList.add("row");

  // const col1 = document.createElement("div");
  // col1.classList.add("col-md-2", "col-sm-12");
  
  const itemNumberHeading = document.createElement("h3");
  itemNumberHeading.classList.add("mt-2", "ml-2");
  itemNumberHeading.textContent = blockCount;
  // col1.appendChild(itemNumberHeading);

  const col2 = document.createElement("div");
  col2.classList.add("col-md-11", "col-sm-12");

  const outfitNameLabel = document.createElement("label");
  outfitNameLabel.setAttribute("for", "outName");
  outfitNameLabel.textContent = "Outfit Name";
  col2.appendChild(outfitNameLabel);

  const outfitNameInput = createInputField("text", "Enter Outfit name..");
  outfitNameInput.id = "outName";
  col2.appendChild(outfitNameInput);

  row1.appendChild(itemNumberHeading);
  row1.appendChild(col2);

  // Add outfit description textarea
  const outfitDescLabel = document.createElement("label");
  outfitDescLabel.setAttribute("for", "outDetail");
  outfitDescLabel.textContent = "Outfit Description";
  
  const outfitDescTextarea = document.createElement("textarea");
  outfitDescTextarea.classList.add("input-field");
  outfitDescTextarea.rows = "3";
  outfitDescTextarea.id = "outDetail";
  outfitDescTextarea.placeholder = "Enter Outfit Description..";

  // Create a row for price, hours, and fabric fields
  const row2 = document.createElement("div");
  row2.classList.add("row");

  const col3 = document.createElement("div");
  col3.classList.add("col-md-3", "col-sm-12");

  const priceLabel = document.createElement("label");
  priceLabel.setAttribute("for", "price");
  priceLabel.textContent = "Price";
  col3.appendChild(priceLabel);

  const priceInput = createInputField("number", "Enter Price..");
  priceInput.id = "price";
  col3.appendChild(priceInput);

  const col4 = document.createElement("div");
  col4.classList.add("col-md-3", "offset-md-1", "col-sm-12");

  const hoursLabel = document.createElement("label");
  hoursLabel.setAttribute("for", "hours");
  hoursLabel.textContent = "Hours";
  col4.appendChild(hoursLabel);

  const hoursInput = createInputField("number", "Enter Hours..");
  hoursInput.id = "hours";
  col4.appendChild(hoursInput);

  const col5 = document.createElement("div");
  col5.classList.add("col-md-3", "offset-md-1", "col-sm-12");

  const fabricLabel = document.createElement("label");
  fabricLabel.setAttribute("for", "fabric");
  fabricLabel.textContent = "Fabric";
  col5.appendChild(fabricLabel);

  const fabricInput = createInputField("number", "Enter Fabric..");
  fabricInput.id = "fabric";
  col5.appendChild(fabricInput);

  row2.appendChild(col3);
  row2.appendChild(col4);
  row2.appendChild(col5);

  // Add button block
  const buttonBlock = document.createElement("div");
  buttonBlock.classList.add("button-block");

  // Add move up button
  const moveUpButton = createButton("move-up", "Up");

  // Add move down button
  const moveDownButton = createButton("move-down", "Down");

  // Add delete button
  const deleteButton = createButton("delete", "Delete");

  // Append elements to the new block
  buttonBlock.appendChild(moveUpButton);
  buttonBlock.appendChild(moveDownButton);
  buttonBlock.appendChild(deleteButton);
  newBlock.appendChild(row1);
  newBlock.appendChild(outfitDescLabel);
  newBlock.appendChild(outfitDescTextarea);
  newBlock.appendChild(row2);
  newBlock.appendChild(buttonBlock);

  // Append the new block to the container
  blockContainer.appendChild(newBlock);
}

// Function to create an input field
function createInputField(type, placeholder) {
  const inputField = document.createElement("input");
  inputField.type = type;
  inputField.classList.add("input-field");
  inputField.placeholder = placeholder;
  return inputField;
}

// Function to create a button
function createButton(className, text) {
  const button = document.createElement("button");
  button.classList.add(className);
  button.textContent = text;
  return button;
}

// Function to move a block up
function moveUp(block) {
  const previousBlock = block.previousElementSibling;
  if (previousBlock) {
    block.parentNode.insertBefore(block, previousBlock);
  }
}

// Function to move a block down
function moveDown(block) {
  const nextBlock = block.nextElementSibling;
  if (nextBlock) {
    block.parentNode.insertBefore(nextBlock, block);
  }
}

// Function to delete a block
function deleteBlock(block) {
  block.parentNode.removeChild(block);
}
