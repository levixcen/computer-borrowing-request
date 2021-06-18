const spoofedFormMethods = ['put', 'patch', 'delete'];

const allowedFormMethods = ['post', 'put', 'patch', 'delete'];

const onElementClickListener = (e) => {
  const formMethod = e.currentTarget.getAttribute('data-method').toLowerCase();

  if (!allowedFormMethods.includes(formMethod)) {
    return;
  }

  if (!e.currentTarget.getAttribute('href')) {
    return;
  }

  e.preventDefault();

  const formElement = document.createElement('form');
  formElement.method = 'POST';
  formElement.action = e.currentTarget.getAttribute('href');
  formElement.style.display = 'none';

  if (spoofedFormMethods.includes(formMethod)) {
    const inputMethodElement = document.createElement('input');
    inputMethodElement.type = 'hidden';
    inputMethodElement.name = '_method';
    inputMethodElement.value = formMethod;

    formElement.appendChild(inputMethodElement);
  }

  const seekAttribute = 'data-form-';
  e.currentTarget.getAttributeNames().forEach((attribute) => {
    const value = e.currentTarget.getAttribute(attribute);

    if (attribute.startsWith(seekAttribute)) {
      const fieldName = attribute.substr(seekAttribute.length);

      const inputElement = document.createElement('input');
      inputElement.type = 'hidden';
      inputElement.name = fieldName;
      inputElement.value = value;

      formElement.appendChild(inputElement);
    }
  });

  document.body.appendChild(formElement);

  formElement.submit();
};

const init = (element) => {
  element.addEventListener('click', onElementClickListener);
};

const onDocumentReady = () => {
  const elements = document.querySelectorAll('a[data-method]');

  if (elements === null) {
    return;
  }

  elements.forEach((element) => {
    init(element);
  });
};

const autoInit = () => {
  document.addEventListener('DOMContentLoaded', onDocumentReady);
};

export default {autoInit};
