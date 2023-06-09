function toggleMenu() {
    const menu = document.querySelector('.navbar-menu');
    if (menu.classList.contains('active')) {
        menu.classList.remove('active');
        menu.classList.add('closed');
        menu.style.maxHeight = '0';
    } else {
        menu.classList.add('active');
        menu.style.maxHeight = menu.scrollHeight + 'px';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var item = document.querySelector('#aboutUs .content .item');
    item.classList.add('animate-shadow');
});

const knowledgeList = document.querySelectorAll('#knowledge .knowledge-list li');
const knowledgeInfo = document.getElementById('knowledge-info');

knowledgeList.forEach((item) => {
    item.addEventListener('click', (e) => {
        const info = JSON.parse(e.target.getAttribute('data-info'));
        knowledgeInfo.innerHTML = `
        <div>
            <picture>
                <img src="images/services/${info.thumbnail}" alt="Thumbnail">
            </picture>
            <h3>${info.name}</h3>
        </div>
        <div class="right">
            <p>${info.description}</p>
            <div class="tags">
            ${
                info.tags.length > 0
                  ? info.tags.map((tag) => `<p>${tag.name}</p>`).join('')
                  : ''
              }
            </div>
        </div>
        `;
        knowledgeInfo.style.display = 'flex';
    });
});