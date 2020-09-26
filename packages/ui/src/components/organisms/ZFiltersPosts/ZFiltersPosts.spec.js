import { shallowMount } from '@vue/test-utils';
import ZFiltersPosts from './ZFiltersPosts.vue';

describe('ZFiltersPosts.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZFiltersPosts);
    expect(component.get('.z-filters-posts'));
  });
});
