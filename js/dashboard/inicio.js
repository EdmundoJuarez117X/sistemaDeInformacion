const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

//Show Sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});
//Close Sidebar
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});


//Change theme Old version
// themeToggler.addEventListener('click', ()=>{
//     document.body.classList.toggle('dark-theme-variables');
//     themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
//     themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

// });
//New Change theme function
const body = document.querySelector('body');
const button = document.querySelector('#darkbutton');
function toggleDark() {
    if (body.classList.contains('dark-theme-variables')) {
        body.classList.remove('dark-theme-variables');
        themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
        themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
        localStorage.setItem("theme", "");
        // button.innerHTML = "Turn on dark mode";
    } else {
        body.classList.add('dark-theme-variables');
        themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');

        themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
        localStorage.setItem("theme", "dark-theme-variables");
        // button.innerHTML = "Turn off dark mode";
    }
}

if (localStorage.getItem("theme") === "dark-theme-variables") {
    body.classList.add('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
    //   button.innerHTML = "Turn off dark mode";
}

document.querySelector('#darkbutton').addEventListener('click', toggleDark);


//Fill orders in table
Orders.forEach(order => {
    const tr = document.createElement('tr');
    const trContent = `
    
                            <td>${order.productName}</td>
                            <td>${order.productNumber}</td>
                            <td class="warning">${order.paymentStatus}</td>
                            <td class="${order.shipping === 'Declined' ? 'danger' : order.shipping === 'pending' ? 'warning' : 'primary'}">${order.shipping}</td>
                            <td>Detalles</td>
    `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
})