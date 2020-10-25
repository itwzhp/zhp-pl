import { shallowMount } from '@vue/test-utils';
import ZMegaMenu from './ZMegaMenu.vue';

describe('ZMegaMenu.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZMegaMenu);
    expect(component.get('.z-mega-menu'));
  });
});
