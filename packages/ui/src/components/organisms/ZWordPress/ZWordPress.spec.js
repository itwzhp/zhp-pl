import { shallowMount } from '@vue/test-utils';
import ZWordPress from './ZWordPress.vue';

describe('ZWordPress.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZWordPress);
    expect(component.get('.z-word-press'));
  });
});
