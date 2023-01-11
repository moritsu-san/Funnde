import axios from 'axios';

const getPosts = async () => {
  const res = await axios.get('/api/post');
  console.log(res);
}

export { getPosts };