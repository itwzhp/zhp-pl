import { shallowMount } from '@vue/test-utils';
import ZPost from './ZPost.vue';

describe('ZPost.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZPost);
    expect(component.contains('.z-post')).toBe(true);
  });
});
