const menuItems = document.querySelectorAll("#main_menu li > span");

for (let i = 0; i < menuItems.length; i++) {
  menuItems[i].addEventListener("click", function() {
    const subMenu = this.nextElementSibling;
    
    // Close any open submenu that is not the parent or the child of the clicked element
    for (let j = 0; j < menuItems.length; j++) {
      const otherSubMenu = menuItems[j].nextElementSibling;
      if (otherSubMenu !== subMenu && !isChildOf(subMenu, otherSubMenu)) {
        otherSubMenu.style.display = "none";
        menuItems[j].classList.remove("clicked");
      }
    }
    
    subMenu.style.display = subMenu.style.display === "block" ? "none" : "block";
    this.classList.toggle("clicked");
  });
}

function isChildOf(child, parent) {
  if (child === parent) {
    return true;
  }
  
  let currentElement = child.parentElement;
  
  while (currentElement != null) {
    if (currentElement === parent) {
      return true;
    }
    currentElement = currentElement.parentElement;
  }
  
  return false;
}

  