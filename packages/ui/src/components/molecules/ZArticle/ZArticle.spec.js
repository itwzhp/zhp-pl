import { shallowMount } from '@vue/test-utils';
import ZArticle from './ZArticle.vue';

describe('ZArticle.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZArticle);
    expect(component.contains('.z-article')).toBe(true);
  });
});
