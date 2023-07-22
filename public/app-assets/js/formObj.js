var blockObjects = [];
// Submit button click event
document.getElementById("submit-button").addEventListener("click", function() {

  const blockContainer = document.getElementById("block-container");
  const blocks = blockContainer.getElementsByClassName("block");
  const previousBlocks = blockContainer.getElementsByClassName("block");
  var errorOccue = false
  for (const block of previousBlocks) {
    const outfitNameInput = block.querySelector("input[id='outName']");
    // const outfitNameInput = block.querySelector("textarea[id='outName']");
    const priceInput = block.querySelector("input[id='price']");
    const hoursInput = block.querySelector("input[id='hours']");
    const fabricInput = block.querySelector("input[id='fabric']");

    if (!outfitNameInput.value) {
      // Show validation error and return without adding new block
      outfitNameInput.classList.add("error");
      outfitNameInput.addEventListener("input", handleInput);
      errorOccue = true
    }
    if(!priceInput.value || priceInput.value < 0)
    {
      priceInput.classList.add("error");
      priceInput.addEventListener("input", handleInput);
      errorOccue = true
    }
    if(!hoursInput.value)
    {
      hoursInput.classList.add("error");
      hoursInput.addEventListener("input", handleInput);
      errorOccue = true
    }
    if(!fabricInput.value)
    {
      fabricInput.classList.add("error");
      fabricInput.addEventListener("input", handleInput);
      errorOccue = true
    }
  }
  if(errorOccue) return

    blockObjects = [];
    // Array to store the block objects
  
    // Iterate over each block
    total = 0
    checker = 0
    for (let i = 0; i < blocks.length; i++) {
      const block = blocks[i];
      var id = null
      // Get the values from the input fields
      const itemNumber = block.querySelector("h3").textContent.replace("Item# ", "");
      const outfitName = block.querySelector("#outName").value;
      const outfitDescription = block.querySelector("#outDetail").value;
      const price = block.querySelector("#price").value;
      const hours = block.querySelector("#hours").value;
      const fabric = block.querySelector("#fabric").value;
      if(orderId != 0)
      {
        try {
          id = block.querySelector("#outId").value;
        } catch (error) {
          id = null
        }
      }
      total += Number(price);
  
      // Create an object for the block
      const blockObject = {
        outfitId: id,
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
    if(orderId == 0)
    {
      createOutfits(4)
    }
    else{
      updateOutfits(4)
    }
  
    // Log the block objects
    // console.log(blockObjects);
  });
  