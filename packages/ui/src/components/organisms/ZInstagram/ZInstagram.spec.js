import { shallowMount } from '@vue/test-utils';
import ZInstagram from './ZInstagram.vue';

describe('ZInstagram.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZInstagram);
    expect(component.get('.z-z-instagram'));
  });
});
