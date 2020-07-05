import {configure} from '@storybook/vue'
import '../../src/styles/styles.scss'
function loadStories(){
  const stories = [];
  const req = require.context('../../src', true, /.stories.(js|jsx|ts|tsx|mdx)/);
  req.keys().forEach(fname => stories.push(req(fname)));;
  return stories;
}
configure(loadStories, module)
