import { shallowMount } from '@vue/test-utils';
import ZPostsFilters from './ZPostsFilters.vue';

describe('ZPostsFilters.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZPostsFilters);
    expect(component.get('.z-posts-filters'));
  });
});
