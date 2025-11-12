// script.js
document.addEventListener('keydown', e => {
    const map = { ArrowLeft: 'left', ArrowRight: 'right', ArrowUp: 'up', ArrowDown: 'down' };
    if (map[e.key]) {
        e.preventDefault();
        move(map[e.key]);
    }
});

function move(direction) {
    console.log('Enviando move:', direction);
    fetch(`index.php?move=${direction}`, { cache: 'no-store' })
        .then(r => {
            if (!r.ok) throw new Error('Resposta não OK: ' + r.status);
            return r.json();
        })
        .then(data => {
            console.log('Resposta move:', data);
            render(data.board, data.score);
            if (data.gameover) {
                setTimeout(()=> alert("Game Over! Pontuação final: " + data.score), 50);
            } else if (!data.moved) {
                // nenhuma mudança — pode tocar um som ou dar feedback visual
                // console.log('Nenhum movimento executado.');
            }
        })
        .catch(err => {
            console.error('Erro na requisição move:', err);
        });
}

function render(board, score) {
    const container = document.getElementById('board');
    const scoreDiv = document.getElementById('score');
    container.innerHTML = '';
    board.forEach(row => {
        row.forEach(v => {
            const d = document.createElement('div');
            const cl = 'tile tile-' + (v === 0 ? 0 : v);
            d.className = cl;
            d.textContent = v === 0 ? '' : v;
            container.appendChild(d);
        });
    });
    scoreDiv.textContent = 'Pontuação: ' + score;
}

function resetGame() {
    window.location = 'index.php?reset=1';
}
