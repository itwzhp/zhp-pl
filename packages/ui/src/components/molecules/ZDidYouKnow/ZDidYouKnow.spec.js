import { shallowMount } from '@vue/test-utils';
import ZDidYouKnow from './ZDidYouKnow.vue';

describe('ZDidYouKnow.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZDidYouKnow);
    expect(component.get('.z-did-you-know'));
  });
});
