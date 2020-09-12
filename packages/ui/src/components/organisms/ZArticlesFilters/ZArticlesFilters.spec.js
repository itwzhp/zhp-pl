import { shallowMount } from '@vue/test-utils';
import ZArticlesFilters from './ZArticlesFilters.vue';

describe('ZArticlesFilters.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZArticlesFilters);
    expect(component.get('.z-articles-filters'));
  });
});
