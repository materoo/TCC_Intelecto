const select1 = document.getElementById('select1');
const select2 = document.getElementById('select2');

// Definir opções iniciais do segundo select
const defaultOptions = {
  matematica: ['Algebra', 'Geometria'],
  portugues: ['Gramatica', 'Interpretação'],
  historia: ['Brasil', 'Geral'],
};

// Função para atualizar as opções do segundo select com base na seleção do primeiro select
function updateOptions() {
  const selectedValue = select1.value;
  const options = defaultOptions[selectedValue];

  // Limpar opções atuais
  select2.innerHTML = '';

  // Adicionar a opção padrão
  const defaultOption = document.createElement('option');
  defaultOption.value = 'default';
  defaultOption.disabled = true; // Desabilitar a opção padrão
  defaultOption.selected = true;
  defaultOption.textContent = 'Assunto';
  select2.appendChild(defaultOption);

  // Adicionar novas opções
  options.forEach((option) => {
    const optionElement = document.createElement('option');
    optionElement.value = option;
    optionElement.textContent = option;
    select2.appendChild(optionElement);
  });
}

// Atualizar as opções do segundo select quando o primeiro select for alterado
select1.addEventListener('change', updateOptions);

// Atualizar as opções iniciais do segundo select
updateOptions();