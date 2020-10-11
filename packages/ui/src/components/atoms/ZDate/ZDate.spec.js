import { shallowMount } from '@vue/test-utils';
import ZDate from './ZDate.vue';

describe('ZDate.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZDate);
    expect(component.get('.z-date'));
  });
});
