var blockObjects = [];
// Submit button click event
document.getElementById("submit-button").addEventListener("click", function() {
    const blockContainer = document.getElementById("block-container");
    const blocks = blockContainer.getElementsByClassName("block");
    blockObjects = [];
    // Array to store the block objects
  
    // Iterate over each block
    total = 0
    checker = 0
    for (let i = 0; i < blocks.length; i++) {
      const block = blocks[i];
  
      // Get the values from the input fields
      const itemNumber = block.querySelector("h3").textContent.replace("Item# ", "");
      const outfitName = block.querySelector("#outName").value;
      const outfitDescription = block.querySelector("#outDetail").value;
      const price = block.querySelector("#price").value;
      const hours = block.querySelector("#hours").value;
      const fabric = block.querySelector("#fabric").value;
      total += Number(price);
  
      // Create an object for the block
      const blockObject = {
        itemNumber: itemNumber,
        outfitName: outfitName,
        outfitDescription: outfitDescription,
        price: price,
        hours: hours,
        fabric: fabric
      };
  
      // Add the block object to the array
      blockObjects.push(blockObject);
    }

    createOutfits(4)
  
    // Log the block objects
    // console.log(blockObjects);
  });
  