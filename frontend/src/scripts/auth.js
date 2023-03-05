
export default async function NotLoged() {
  if (!localStorage.getItem('auth:cinhall')) {
    return false;
  } else {
    const jwt = JSON.parse(localStorage.getItem('auth:cinhall'))
    await axios({
      method: 'get',
      url: 'http://cdn.cinehall.ma/users/tokenIsValid',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${jwt}`,
      },
    })
      .then((result) => {
        return !result.data.success;
      })
      .catch((error) => {
        return false;
      })
  }
}
