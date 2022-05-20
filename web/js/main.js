const SERVER_UNAVAILABLE_MESSAGE = 'Server is not working, please try again later.';
const SERVER_ERROR_MESSAGE = 'Internal server error, please try again later.';

const SERVER_ADDRESS = '/';

const FORM_SELECTOR = '#request-form';
const URL_INPUT_SELECTOR = '.js-source-url';
const SUBMIT_BUTTON_SELECTOR = '.js-submit';
const RESULT_ELEMENT_SELECTOR = '.js-result';

const urlInput = document.querySelector(URL_INPUT_SELECTOR);
const submitButton = document.querySelector(SUBMIT_BUTTON_SELECTOR);
const resultElement = document.querySelector(RESULT_ELEMENT_SELECTOR);

$(FORM_SELECTOR).on('beforeSubmit', function (evt) {
  const data = new FormData();
  data.set('sourceUrl', urlInput.value)
  sendRequest(SERVER_ADDRESS, data, handleResponse, handleFail);

  // Не выполнять submit
  return false;
});

const sendRequest = async (url, data, onSuccess, onFail) => {
  let response;

  try {
    response = await fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      body: data,
    });
  } catch (error) {
    onFail(SERVER_UNAVAILABLE_MESSAGE);
    return;
  }

  if (!response.ok) {
    onFail(SERVER_ERROR_MESSAGE);
    return;
  }

  response = await response.json();
  onSuccess(response);
}

const handleResponse = (data) => {
  resultElement.textContent = `${window.location.origin}/${data.shortUrl}`;
  selectText(resultElement);
}

const handleFail = (error) => {
  resultElement.textContent = error;
}

const selectText = (node) => {
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(node);
    selection.removeAllRanges();
    selection.addRange(range);
}
