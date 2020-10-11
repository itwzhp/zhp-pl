import { shallowMount } from '@vue/test-utils';
import ZFiles from './ZFiles.vue';

describe('ZFiles.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZFiles);
    expect(component.get('.z-files'));
  });
});
